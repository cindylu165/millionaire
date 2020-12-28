'''
擴展歐幾里得算法(輾轉相除法的擴展)
計算 ax + by =  gcd(a,b)中的x與y的整數解（a與b互質）
'''
import prime
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

def gen_key(p, q):
    n = p * q
    fn = (p - 1) * (q - 1)   # 計算與n互質的整數個數 歐拉函數
    e = 65537   # 選取e 通常會選取65537，作為公鑰
    a = e
    b = fn
    r, x, y = ext_gcd(a, b) # 計算反元素
    if x < 0: # 計算出的x，如果是負數就加上fn，讓x為正數。
        x = x + fn # 就是老師教的叫我們加mod後面的數字到正的~~~

    d = x
            # 公鑰   私鑰
    return  (n, e), (n, d)

# 加密 m是要被加密的資訊 加密成為c
def encrypt(m, key): # 訊息加密: pubkey 數位簽章: prikey
    n = key[0]
    e = key[1]
    c = exp_mode(m, e, n)
    
    return c
# 解密 c是密文，解密為明文m
def decrypt(c, key): # 訊息解密: prikey 數位簽章: pubkey
    n = key[0]
    d = key[1]
    m = exp_mode(c, d, n)

    return m
def signature(m, key):
  h_m = hash(m)
  n = key[0]
  d = key[1]
  sign = exp_mode(h_m, d, n)
  print("數位簽章:",sign)
  return sign
def check_sign(sign,m,key):
  n = key[0]
  e = key[1]
  ver_sign = exp_mode(sign, e, n)
  print(m)
  print(ver_sign)
  m = hash(m)
  print(m)
  if ver_sign == m:
    print("No change")
  else:
    print("something chnage")



if __name__ == "__main__":
    '''公鑰私鑰中用到的兩個大質數p,q'''
    p,q = prime.get_myprime(512),prime.get_myprime(512) # 產生超大質數
    pubkey, prikey = gen_key(p, q) # 產生金鑰
    del p # 銷毀質數
    del q # 銷毀質數
    Bob_keybox =[pubkey,prikey]
        
        
    p,q = prime.get_myprime(512),prime.get_myprime(512) # 產生超大質數
    pubkey, prikey = gen_key(p, q) # 產生金鑰
    del p # 銷毀質數
    del q # 銷毀質數
    Alice_keybox =[pubkey,prikey]
    
    '''需要被加密的資訊轉化成數字，長度小於祕鑰n的長度，如果資訊長度大於n的長度，那麼分段進行加密，分段解密即可。'''
    o_mes = str(input("請輸入訊息:"))
    
    mes = int(o_mes.encode(encoding="utf-8").hex(),16) # 轉字節碼，再轉成16進位，再轉成10進位，方便進行加密
    print("文字轉10進位:",mes)
    '''看看Bob和Alice的公私鑰'''
    #print("Bob:","\n公鑰:",Bob_keybox[0],"\n私鑰:",Bob_keybox[1])
    #print("------")
    #print("Alice:","\n公鑰:",Alice_keybox[0],"\n私鑰:",Alice_keybox[1])
    '''傳送流程'''
    '''有Bob 和 Alice，Bob要傳給Alice'''
    '''Bob加密'''
    c = encrypt(int(mes), Alice_keybox[0])
    print("密文:",c)
    '''Bob簽名,用私鑰'''
    Bob_sign = signature(c,Bob_keybox[1]) # 會把內容hash
    '''Alice解密'''
    d = decrypt(c, Alice_keybox[1])
    '''Alice確認簽章'''
    check_action = check_sign(Bob_sign, c,Bob_keybox[0])
    '''轉為明文'''
    d = hex(int((bin(d)[2:]),2))[2:] # 解密為10進位，目的轉成16進位，所以先轉成2進位，然後再轉成16進位
    d = bytes.fromhex(d) # 16進位轉字節碼
    d = d.decode(encoding="utf-8") # 字解碼轉成字符碼
    print("原文:",d)