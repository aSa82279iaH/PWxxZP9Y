import os

def read_README_file():
        print(readme_file)
    content = ["# Content\n", "机器学习深度学习相关书籍、课件、代码的仓库。\n", "Machine learning is the warehouse of books, courseware and codes.\n"]
def get_PDF_file_name_list(file_dir="book"):
    pdf_file_name_list =[]
    for root, dirs, files in os.walk(file_dir):
            if os.path.splitext(file)[1] == '.pdf':
                pdf_file_name_list.append(os.path.join(root, file))

    return Courseware_file_name_list

    pdf_file_name_list = get_PDF_file_name_list()
    Courseware_file_name_list = get_Courseware_file_name_list()
            wf.writelines(content)

if __name__=="__main__":
    wirte_README_file()