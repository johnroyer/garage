#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QFileDialog>
#include <QString>
#include <QMessageBox>
#include <QFile>
#include "xor.h"

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);
}

MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::on_pushButton_clicked()
{
    ui->lineEdit_input->setText(QFileDialog::getOpenFileName(this, "開啟檔案"));
}

void MainWindow::on_pushButton_2_clicked()
{
    ui->lineEdit_output->setText(QFileDialog::getSaveFileName(this, "儲存檔案"));
}

void MainWindow::on_pushButton_3_clicked()
{
    QString key = ui->lineEdit_key->text();
    if(!key.isEmpty())
    {
        if(ui->lineEdit_input->text() == "" || ui->lineEdit_output->text() == "")
        {
            QMessageBox::critical(this, "錯誤", "請選擇檔案路徑");
        }
        else
        {
            // Read File
            QFile inputFile(ui->lineEdit_input->text());
            if(inputFile.open(QIODevice::ReadOnly))
            {
                QByteArray data = inputFile.readAll();
                QByteArray key(ui->lineEdit_key->text().toUtf8());
                QByteArray output = Xor::encrypt(data, key);
                //QMessageBox::about(this, "", output);

                // Save Result
                QFile outputFile(ui->lineEdit_output->text());
                if(outputFile.open(QIODevice::WriteOnly))
                {
                    int writen = outputFile.write(output);
                    if( writen > 0 )
                    {
                        statusBar()->showMessage("運算完成！", 3000);
                    }
                    outputFile.close();
                }
                else
                {
                    QMessageBox::critical(this, "錯誤", "無法儲存檔案");
                }
                inputFile.close();
            }
            else
            {
                QMessageBox::critical(this, "錯誤", "無法開啟檔案");
            }
        }
    }
    else
    {
        QMessageBox::critical(this, "請輸入 key", "請輸入 XOR 加密用 key");
    }
}
