from fpdf import *

pdf = FPDF(orientation='P', unit='mm', format='A4')
pdf.add_page()
def write(x:int, y:int, size:int, text:str):
    























pdf.output('simple_demo.pdf')