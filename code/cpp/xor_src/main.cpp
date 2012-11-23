#include <QtGui/QApplication>
#include "mainwindow.h"
#include <QTextCodec>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);

    // Set text codec
    QTextCodec::setCodecForCStrings( QTextCodec::codecForName( "UTF-8" ) );
    QTextCodec::setCodecForTr( QTextCodec::codecForName( "UTF-8" ) );

    // Add library path
    a.addLibraryPath(a.applicationDirPath());

    MainWindow w;
    w.show();
    
    return a.exec();
}
