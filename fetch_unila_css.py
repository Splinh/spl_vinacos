import urllib.request
import re

url = 'https://unila.com.vn/tam-the-cong-su-unila-viet-nam/'
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
html = urllib.request.urlopen(req).read().decode('utf-8', errors='ignore')

css_files = re.findall(r'href=["\'](https?://[^\'"]+\.css[^\'"]*)["\']', html)
print("CSS files found:")
for c in css_files:
    print(c)

for c in css_files:
    try:
        css_req = urllib.request.Request(c, headers={'User-Agent': 'Mozilla/5.0'})
        css_text = urllib.request.urlopen(css_req).read().decode('utf-8', errors='ignore')
        if 'button-menu' in css_text or 'buttonMenu' in css_text:
            print(f"\nFound button-menu in {c}:")
            matches = re.findall(r'[^{}]*button-menu[^{}]*\{[^{}]*\}', css_text)
            for m in matches:
                print(m)
    except Exception as e:
        print(f"Error reading {c}: {e}")
