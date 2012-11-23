#include "xor.h"
#include <QByteArray>

Xor::Xor()
{
}

QByteArray Xor::encrypt(QByteArray plaintext, QByteArray key)
{
    int dataIndex = 0;
    int keyIndex = 0;
    QByteArray out("");
    while(dataIndex < plaintext.size())
    {
        out.append(plaintext[dataIndex] ^ key[keyIndex % key.size()]);
        dataIndex++;
        keyIndex++;
    }
    return out;
}
