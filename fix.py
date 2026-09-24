import os
import re

pattern = re.compile(r"\{\{\s*app\(\)->getLocale\(\)\s*===\s*'id'\s*\?\s*'(.*?)'\s*:\s*'(.*?)'\s*\}\}")

for root, dirs, files in os.walk("resources/views/admin"):
    for file in files:
        if file.endswith(".php"):
            filepath = os.path.join(root, file)
            with open(filepath, "r", encoding="utf-8") as f:
                content = f.read()
            
            new_content = pattern.sub(r"\1", content)
            
            if new_content != content:
                with open(filepath, "w", encoding="utf-8") as f:
                    f.write(new_content)
                print(f"Updated {filepath}")
