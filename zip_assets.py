import os
import zipfile
import shutil
import sys

# Ensure stdout uses UTF-8 to avoid console encoding issues
if sys.stdout.encoding != 'utf-8':
    try:
        from io import TextIOWrapper
        sys.stdout = TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    except:
        pass

source_dir = r"c:\Users\user\Desktop\Nerman_NEW_disegn\static"
output_dir = r"c:\Users\user\Desktop\Nerman_NEW_disegn"
max_size = 950 * 1024 * 1024  # 950 MB limit for safety

def create_zip_parts():
    part = 1
    current_zip_path = os.path.join(output_dir, f"Nerman_Assets_Part{part}.zip")
    current_zip = zipfile.ZipFile(current_zip_path, 'w', zipfile.ZIP_DEFLATED, allowZip64=True)
    current_size = 0

    print(f"Starting zipping assets from {source_dir}...")

    total_files = 0
    for root, dirs, files in os.walk(source_dir):
        for file in files:
            file_path = os.path.join(root, file)
            try:
                file_size = os.path.getsize(file_path)
            except OSError:
                continue
            
            # If adding this file exceeds the limit, close current zip and open new one
            if current_size + file_size > max_size and current_size > 0:
                current_zip.close()
                print(f"--> [SUCCESS] Created Part {part}: {os.path.basename(current_zip_path)} ({current_size // (1024*1024)} MB)")
                part += 1
                current_zip_path = os.path.join(output_dir, f"Nerman_Assets_Part{part}.zip")
                current_zip = zipfile.ZipFile(current_zip_path, 'w', zipfile.ZIP_DEFLATED, allowZip64=True)
                current_size = 0
                
            arcname = os.path.relpath(file_path, source_dir)
            try:
                # Use metadata and potentially fix arcname for windows/linux compatibility
                current_zip.write(file_path, arcname)
                current_size += file_size
                total_files += 1
                if total_files % 100 == 0:
                    print(f"Processed {total_files} files...")
            except Exception as e:
                # Print to stderr to avoid mixing with zip operations if necessary
                sys.stderr.write(f"Warning: Could not add {arcname}: {str(e)}\n")

    current_zip.close()
    print(f"--> [SUCCESS] Created Final Part {part}: {os.path.basename(current_zip_path)} ({current_size // (1024*1024)} MB)")
    print(f"Total parts: {part}. Total files processed: {total_files}")

if __name__ == "__main__":
    create_zip_parts()
