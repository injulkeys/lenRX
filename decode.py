import requests
import re
from collections import defaultdict

api_key = "rXOega4DCFRSiBFFC1EjgaJgcu19Dl1FbDwYZw2I"
base_url = "https://api.fda.gov/drug/ndc.json"

def detail(prod):

    result = defaultdict(lambda: "na")
    
    # assumption is that first fourteen characters is gtin
    pack_ndc = re.findall(r'\^01[\d]{14}',prod)

    if len(pack_ndc) == 0:
        return None
    else:
        pack_ndc = pack_ndc[0][3:]

    result['gtin'] = format_gtin(pack_ndc)

    for match in re.finditer(r'17[\d]{6}', prod):
        pos = match.start()
        val = match.group()
    
    result['exp'] = val[2:]
    result['sno'] = prod[19:pos]

    for match in re.finditer(result['exp'],prod):
        pos = match.end()

    result['lot'] = prod[pos:][2:-1]

    return result

def format_gtin(id):
    id = id[3:-1]
    temp = "".join([id[:5],'-',id[5:],])
    res = "".join([temp[:9],'-',temp[9:]])
    return res

