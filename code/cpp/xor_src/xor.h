#ifndef XOR_H
#define XOR_H

#include <QString>

class Xor
{
public:
    Xor();

    static QByteArray encrypt(QByteArray plaintext, QByteArray key);
};

#endif // XOR_H
