from pysnmp.entity.rfc3413.oneliner import cmdgen

def snmpget(ip, port, community, oid):
    
    cmdGen = cmdgen.CommandGenerator()
    
    errorIndication, errorStatus, errorIndex, varBinds = cmdGen.getCmd(
    cmdgen.CommunityData(community),
    cmdgen.UdpTransportTarget((ip, port)),
    oid)

    print('\n'.join([ '%s = %s' % varBind for varBind in varBinds]))

snmpget("10.100.0.50", 161, "public", ".1.3.6.1.4.1.3222.4.6.1.1.5.1")
    
    
