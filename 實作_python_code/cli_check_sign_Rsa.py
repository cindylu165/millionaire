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

def check_sign(sign,m,key):
  n = key[0]
  e = key[1]
  ver_sign = exp_mode(sign, e, n)
  m = hash(m)
  if ver_sign == m:
    return True
  else:
    return False

if __name__ == "__main__":
    mes_form = sys.argv[1] 
    sign = sys.argv[2]
    key = [2476557599,65537] #pubkey
    light_mes = check_sign(sign,mes_form,key)
    if light_mes == True:
        light_mes = json.dumps(True)
        print(light_mes)
    else:
        light_mes = json.dumps(False)
        print(light_mes)