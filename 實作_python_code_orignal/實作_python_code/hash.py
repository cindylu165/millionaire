import sys
import hashlib
# from hashlib import sha256
import json

def hashFunction(message):
    message = message.encode("UTF-8")
    s = hashlib.sha1()
    s.update(message)
    hashed = s.hexdigest()
    hashed = int(hashed,16)
    return str(hashed)
def main():
    mes_form = str(sys.argv[1])
    mes_form += str(sys.argv[2])
    mes_form += str(sys.argv[3])
    mes_form += str(sys.argv[4])
    mes_form += str(sys.argv[5])
    hashed = hashFunction(mes_form)
    hh_ = json.dumps(hashed)
    print(hh_)
    # print(type(hashed))
main()