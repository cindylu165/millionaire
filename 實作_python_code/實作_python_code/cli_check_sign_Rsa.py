'''
擴展歐幾里得算法(輾轉相除法的擴展)
計算 ax + by =  gcd(a,b)中的x與y的整數解（a與b互質）
'''
import sys
import json
import hashlib
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
    m = str(m).encode('utf-8')
    s = hashlib.sha1()
    s.update(m)
    m = s.hexdigest()
    m = int(m, 16)
    if ver_sign == m:
        return True
    else:
        return False

if __name__ == "__main__":
    mes_form = int(sys.argv[1]) 
    sign = int(sys.argv[2])
    key = [4157285537504938667212886179901816408586781316084678683714430710302763106108127551912498942978086617587872526227168748309181226420893909952365295226716589059180302968930765706731878484456301437278651784782026495490557170814165209120157279717087175418143488099984170075844724055687532493219074452408628436726132616675231616631094954983708626926389721047612741370745292012700557689996235603567948730881901270333454376618010536107322966804711212017628681211897681113677451191816237561578758533026280538069513726717304625599319631730344597978250150156586515555548866996213762901369718089146774212794927536375576497598063113,65537] #pubkey
    light_mes = check_sign(sign,mes_form,key)
    if light_mes == True:
        light_mes = json.dumps("True")
        print(light_mes)
    else:
        light_mes = json.dumps("False")
        print(light_mes)