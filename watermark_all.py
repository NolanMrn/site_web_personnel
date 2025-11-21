from PIL import ExifTags

def correct_orientation(image):
    try:
        exif = image._getexif()
        if exif is not None:
            for orientation in ExifTags.TAGS.keys():
                if ExifTags.TAGS[orientation]=='Orientation':
                    break
            o = exif.get(orientation, 1)
            if o == 3:
                image = image.rotate(180, expand=True)
            elif o == 6:
                image = image.rotate(270, expand=True)
            elif o == 8:
                image = image.rotate(90, expand=True)
    except Exception:
        pass
    return image

#!/usr/bin/env python3
"""
watermark_all.py
Parcourt récursivement le dossier `img` et applique un filigrane (textuel ou image)
sur chaque image trouvée. Sauvegarde dans le même endroit avec suffixe `_wm`
ou peut écraser si OVERWRITE=True.
"""

from PIL import Image, ImageDraw, ImageFont, ImageEnhance
import os

# ----------------- ÉLÉMENTS À CHANGER -----------------
SOURCE_DIR = "public/img/"  # dossier racine à parcourir
OUTPUT_SUFFIX = ""                      # suffixe ajouté aux fichiers de sortie
OVERWRITE = True                          # True pour écraser les fichiers originaux
USE_IMAGE_WATERMARK = False                 # True = logo, False = texte
WATERMARK_IMAGE_PATH = "logo.png"          # chemin vers le logo
WATERMARK_TEXT = "Exploratio_nln"         # texte du filigrane
FONT_PATH = "Anton/Anton-Regular.ttf"      # chemin vers un fichier .ttf local
FONT_SIZE_RATIO = 0.05                     # proportion de la hauteur de l'image
OPACITY = 1.0                              # opacité du filigrane (0.0 - 1.0)
MARGIN_RATIO = 0.02                        # marge en proportion de la largeur de l'image
POSITION = "bottom-right"                  # "top-left", "top-right", "bottom-left", "bottom-right", "center"
ALLOWED_EXT = {".jpg", ".jpeg", ".png", ".bmp", ".tiff", ".webp"}  # extensions traitées
EXCLUDE_DIRS = {"accueil"}                 # dossier a exclure
# -------------------------------------------------------

def apply_text_watermark(img: Image.Image, text: str, font_path: str, font_size_ratio: float, opacity: float, position: str, margin_ratio: float):
    base = img.convert("RGBA")
    width, height = base.size

    margin = int(width * margin_ratio)

    font_size = max(12, int(height * font_size_ratio))
    try:
        font = ImageFont.truetype(font_path, font_size)
    except Exception:
        font = ImageFont.load_default()

    text_layer = Image.new("RGBA", base.size, (255,255,255,0))
    draw = ImageDraw.Draw(text_layer)
    bbox = draw.textbbox((0,0), text, font=font)
    text_w = bbox[2] - bbox[0]
    text_h = bbox[3] - bbox[1]

    if position == "top-left":
        x, y = margin, margin
    elif position == "top-right":
        x, y = width - text_w - margin, margin
    elif position == "bottom-left":
        x, y = margin, height - text_h - margin
    elif position == "center":
        x, y = (width - text_w)//2, (height - text_h)//2
    else:  # bottom-right
        x, y = width - text_w - margin, height - text_h - margin

    alpha = int(255 * opacity)
    draw.text((x, y), text, font=font, fill=(255,255,255, alpha))

    combined = Image.alpha_composite(base, text_layer)
    return combined.convert(img.mode)

def apply_image_watermark(img: Image.Image, watermark_img_path: str, opacity: float, position: str, margin_ratio: float, scale_ratio: float = 0.2):
    base = img.convert("RGBA")
    width, height = base.size

    margin = int(width * margin_ratio)

    wm = Image.open(watermark_img_path).convert("RGBA")
    new_w = int(width * scale_ratio)
    w_ratio = new_w / wm.width
    new_h = int(wm.height * w_ratio)
    wm = wm.resize((new_w, new_h), Image.LANCZOS)

    if opacity < 1.0:
        alpha = wm.split()[3]
        alpha = ImageEnhance.Brightness(alpha).enhance(opacity)
        wm.putalpha(alpha)

    if position == "top-left":
        x, y = margin, margin
    elif position == "top-right":
        x, y = width - wm.width - margin, margin
    elif position == "bottom-left":
        x, y = margin, height - wm.height - margin
    elif position == "center":
        x, y = (width - wm.width)//2, (height - wm.height)//2
    else:  # bottom-right
        x, y = width - wm.width - margin, height - wm.height - margin

    layer = Image.new("RGBA", base.size, (255,255,255,0))
    layer.paste(wm, (x, y), wm)
    combined = Image.alpha_composite(base, layer)
    return combined.convert(img.mode)

def process_file(path: str):
    dirname, filename = os.path.split(path)
    name, ext = os.path.splitext(filename)
    if ext.lower() not in ALLOWED_EXT:
        print(f"Skipped (ext): {path}")
        return

    try:
        with Image.open(path) as im:
            im = correct_orientation(im)
            print(f"Processing: {path}")
            if USE_IMAGE_WATERMARK:
                out_img = apply_image_watermark(im, WATERMARK_IMAGE_PATH, OPACITY, POSITION, MARGIN_RATIO)
            else:
                out_img = apply_text_watermark(im, WATERMARK_TEXT, FONT_PATH, FONT_SIZE_RATIO, OPACITY, POSITION, MARGIN_RATIO)

            if OVERWRITE:
                out_path = path
            else:
                out_name = f"{name}{OUTPUT_SUFFIX}{ext}"
                out_path = os.path.join(dirname, out_name)

            save_kwargs = {}
            if ext.lower() in {".jpg", ".jpeg"}:
                save_kwargs["quality"] = 90
                save_kwargs["subsampling"] = 0

            out_img.save(out_path, **save_kwargs)
            print(f"Saved: {out_path}")
    except Exception as e:
        print(f"Error processing {path}: {e}")

def walk_and_process(root_dir: str):
    for dirpath, dirnames, filenames in os.walk(root_dir):
        dirnames[:] = [d for d in dirnames if d not in EXCLUDE_DIRS]
        for fn in filenames:
            process_file(os.path.join(dirpath, fn))

if __name__ == "__main__":
    if not os.path.isdir(SOURCE_DIR):
        print(f"Source directory '{SOURCE_DIR}' introuvable.")
    else:
        walk_and_process(SOURCE_DIR)
        print("Terminé.")
