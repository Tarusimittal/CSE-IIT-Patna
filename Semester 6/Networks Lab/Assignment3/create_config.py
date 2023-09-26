import json

# a Python object (dict):
x = {
  "max_concurrent_thread": 4,
  "blockIp": ['192.168.1.23'],
  "defaultFile": "/alpha.html"
}


print(x)
with open("configuration.json", "w") as outfile:
    json.dump(x, outfile)
