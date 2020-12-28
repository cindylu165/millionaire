import sys
import json

def main(mes):
    value =lhash(mes)
    return value
if __name__ == "__main__":
    mes = sys.argv[1]
    close_value = main(mes)
    close_value = json.dumps(close_value)
    print(close_value)