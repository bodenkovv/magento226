#!/usr/bin/env sh

# A FOLDER WHERE ALL CERTIFICATES WILL BE SAVED TO!
sslCertificateStorage="/misc/share/ssl"

if [ -z $1 ]; then echo "Domain is missed";
else
    mkdir -p ${sslCertificateStorage}
    rm -rf ${sslCertificateStorage}/$1
    mkdir ${sslCertificateStorage}/$1

    rm ./certificate-config.conf -f
    config="[req]\n
default_bits       = 4096\n
encrypt_key        = no\n
default_md         = sha256\n
distinguished_name = req_distinguished_name\n
req_extensions = v3_req\n

[req_distinguished_name]\n

[v3_req]\n
basicConstraints = CA:TRUE\n
subjectAltName = @alt_names\n

[ alt_names ]"

dnsCount=0
for var in "$@"
do
    dnsCount=$((dnsCount+1))
    config=${config}"\nDNS.$dnsCount=$var"
    dnsCount=$((dnsCount+1))
    config=${config}"\nDNS.$dnsCount=www.$var"
done

echo ${config} >> certificate-config.conf

    sudo openssl genrsa 4096 > ${sslCertificateStorage}/$1/$1.key
    sudo openssl req -new -key ${sslCertificateStorage}/$1/$1.key -out ${sslCertificateStorage}/$1/$1.csr -subj /C=UA/ST=Cherkaska/L=Cherkasy/O=Default\ Value/OU=Magento\ Team/CN=$1

    #sudo openssl x509 -req -days 9999 -CA ${sslCertificateStorage}/DefaultValueCA.pem -CAkey ${sslCertificateStorage}/DefaultValueCA.key -CAcreateserial  -in ${sslCertificateStorage}/$1/$1.csr -signkey ${sslCertificateStorage}/$1/$1.key -out ${sslCertificateStorage}/$1/$1.crt -extensions v3_req -extfile ./certificate-config.conf
    sudo openssl x509 -req -days 9999 -in ${sslCertificateStorage}/$1/$1.csr -signkey ${sslCertificateStorage}/$1/$1.key -out ${sslCertificateStorage}/$1/$1.crt -extensions v3_req -extfile ./certificate-config.conf

    # Uncomment to view the certificate content
    # openssl x509 -in ${sslCertificateStorage}/$1/$1.crt -text -noout

    # Comment if you do not want to delete certificate-config.conf file after generating certificate (for debug reasons
    rm ./certificate-config.conf -f

    sudo openssl x509 -in ${sslCertificateStorage}/$1/$1.crt -out ${sslCertificateStorage}/$1/$1.pem
    sudo chown -R ${USER}:${USER} ${sslCertificateStorage}/$1

    echo "\n"
    echo "SSLCertificateFile ${sslCertificateStorage}/$1/$1.crt"
    echo "SSLCertificateKeyFile ${sslCertificateStorage}/$1/$1.key"
fi
