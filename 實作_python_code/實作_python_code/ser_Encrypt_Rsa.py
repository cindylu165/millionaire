'''
擴展歐幾里得算法(輾轉相除法的擴展)
計算 ax + by =  gcd(a,b)中的x與y的整數解（a與b互質）
'''
import sys
import json
def ext_gcd(a, b):
    if b == 0:
        x1 = 1
        y1 = 0
        x = x1
        y = y1
        r = a
        return r, x, y
    else:
        r, x1, y1 = ext_gcd(b, a % b)
        x = y1
        y = x1 - (a // b) * y1
        return r, x, y
'''
蒙哥馬利演算法
'''
def exp_mode(base, exponent, n):
    bin_array = bin(exponent)[2:][::-1]
    r = len(bin_array)
    base_array = []

    pre_base = base
    base_array.append(pre_base)

    for _ in range(r - 1):
        next_base = (pre_base * pre_base) % n
        base_array.append(next_base)
        pre_base = next_base

    a_w_b = __multi(base_array, bin_array, n)
    return a_w_b % n

def __multi(array, bin_array, n):
    result = 1
    for index in range(len(array)):
        a = array[index]
        if not int(bin_array[index]):
            continue
        result *= a
        result = result % n 
    return result

def encrypt(m, key): # 訊息加密: pubkey 數位簽章: prikey
    n = key[0]
    e = key[1]
    c = exp_mode(m, e, n)
    
    return c

if __name__ == "__main__":
    '''公鑰私鑰中用到的兩個大質數p,q'''
    mes_form = int(sys.argv[1])
    guest_pubkey= str(sys.argv[2])
    guest_pubkey = list(map(int,guest_pubkey.split(",")))
    key = [guest_pubkey[0],guest_pubkey[1]]
    enc_mes = encrypt(mes_form,key)
    enc_mes = json.dumps(str(enc_mes))
    print(enc_mes)