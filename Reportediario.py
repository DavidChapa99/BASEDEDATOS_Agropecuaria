"""import win32com.client
def imprimir_hoja(repdiario,repservicios):
    excel = win32com.client.Dispatch("Excel.Application")
    excel.visible = False

    try:
        libro = excel.Workbooks.open(repdiario)
        hoja = libro.worksheets[repservicios]
        hoja.printout()
    except Exception as e:
        print(f"Error al imprimir: {e}")
    finally:
        excel.quit()

repdiario = r"\\VENTAS\Compartidos\REPORTES_PLANTILLAS\Formatos Reportes 2013.xlsx"
repservicios = "Reporte Servicios"

imprimir_hoja(repdiario,repservicios)"""
import os
def imprimir_repact(act_servicios):
    comand = f'start excel "{act_servicios}" /select:"{hoja}"'
    os.system(comand)
#"\\VENTAS\Compartidos\SERVICIOS\ACT_SERVICIOS_EN_BLANCO.xlsx"
act_servicios = r"\\VENTAS\Compartidos\REPORTES_PLANTILLAS\Formatos Reportes 2013.xlsx"
hoja = "Reporte_diario"
imprimir_repact(act_servicios)