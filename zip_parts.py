import zipfile
import os

def zip_items(items, output_filename, base_path='static'):
    print(f"Zipping {items} into {output_filename}...")
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for item in items:
            full_path = os.path.join(base_path, item) if base_path else item
            if os.path.isdir(full_path):
                for root, dirs, files in os.walk(full_path):
                    for file in files:
                        file_path = os.path.join(root, file)
                        # We want the 'static/...' part in the zip
                        rel_path = os.path.relpath(file_path, os.path.dirname(base_path) if base_path else ".")
                        zipf.write(file_path, rel_path)
            elif os.path.isfile(full_path):
                rel_path = os.path.relpath(full_path, os.path.dirname(base_path) if base_path else ".")
                zipf.write(full_path, rel_path)
    print(f"Finished {output_filename}")

if __name__ == "__main__":
    # 1. Core + UI
    zip_items(['css', 'js', 'img', 'videos'], 'Assets_Part1_Core.zip')
    
    # 2. Backgrounds
    zip_items(['materials/backgrounds', 'materials/backgrounds_new'], 'Assets_Part2_Backgrounds.zip')
    
    # 3. Transitions
    zip_items(['materials/transitions', 'materials/transitions_new'], 'Assets_Part3_Transitions.zip')
    
    # 4. Visual Elements + Sounds + Music + Rest
    zip_items(['materials/visual-elements', 'materials/sounds', 'materials/sounds_new', 'materials/fonts', 'materials/overlays', 'materials/thumbnails', 'music'], 'Assets_Part4_Library.zip')
