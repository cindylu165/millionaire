import sys
import json
import hashlib
def main(message):
    message = message.encode("UTF-8")
    s = hashlib.sha1()
    s.update(message)
    hashed = s.hexdigest()
    hashed = int(hashed,16)
    return str(hashed)

    
if __name__ == "__main__":
    mes_form = str(sys.argv[1])
    close_value = main(mes_form)
    close_value = json.dumps(close_value)
    print(close_value)