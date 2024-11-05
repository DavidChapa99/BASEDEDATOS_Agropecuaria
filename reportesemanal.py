import os
def imprimir_repact(act_servicios):
    comand = f'start excel "{act_servicios}" /p'
    os.system(comand)
#"\\VENTAS\Compartidos\SERVICIOS\ACT_SERVICIOS_EN_BLANCO.xlsx"
act_servicios = r"\\VENTAS\Compartidos\SERVICIOS\ACT_SERVICIOS_EN_BLANCO.xlsx"
imprimir_repact(act_servicios)