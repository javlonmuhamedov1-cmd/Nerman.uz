import zipfile
import os

def zip_directory(path, output_filename):
    print(f"Zipping {path} into {output_filename}...")
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(path):
            if '__pycache__' in dirs:
                dirs.remove('__pycache__')
            for file in files:
                file_path = os.path.join(root, file)
                rel_path = os.path.relpath(file_path, os.path.join(path, ".."))
                zipf.write(file_path, rel_path)
    print(f"Finished zipping {path}.")

if __name__ == "__main__":
    if os.path.exists("media"):
        zip_directory("media", "media_assets.zip")
    else:
        print("Media folder not found.")
