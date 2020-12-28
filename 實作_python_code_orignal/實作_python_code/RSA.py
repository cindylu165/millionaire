'''
輾轉相除法
計算 ax   by = 1中的x與y的整數解（a與b互質）
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
        result = result % n # 加快速度
    return result

'''
產生金鑰
'''
def gen_key(p, q):
    n = p * q
    fn = (p - 1) * (q - 1)   # 計算與n互質的整數個數 歐拉函數
    e = 65537   # 選取e 通常會選取65537，作為公鑰
    a = e
    b = fn
    r, x, y = ext_gcd(a, b) # 計算反元素
    if x < 0: # 計算出的x不能是負數，如果是負數就加上fn，讓x為正數。
        x = x + fn # 就是老師教的叫我們加mod後面的數字到正的~~~
        
    d = x
            # 公鑰   私鑰
    return  (n, e), (n, d)

# 加密 m是被加密的資訊 加密成為c
def encrypt(m, pubkey):
    n = pubkey[0]
    e = pubkey[1]
    c = exp_mode(m, e, n)
    print("c",c)
    return c
# 解密 c是密文，解密為明文m
def decrypt(c, prikey):
    n = prikey[0]
    d = prikey[1]
    m = exp_mode(c, d, n)
    return m

if __name__ == "__main__":
    '''公鑰私鑰中用到的兩個大質數p,q'''
    hash_v = sys.argv[1]
    hash_v = int(hash_v)
    winner_num = hash_v % 43
    winner_num = json.dumps(winner_num)
    print(winner_num)