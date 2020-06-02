[gammu]
# isikan no port di bawah ini
port = com100:
# isikan jenis connection di bawah ini
connection = at100

[smsd]
service = mysql
logfile = smsdlog
debuglevel = 0
phoneid = com100
commtimeout = 30
sendtimeout = 30
PIN = 1234

# -----------------------------
# Konfigurasi koneksi ke MySQL
# -----------------------------
pc = localhost

# isikan user untuk akses ke MySQL
user = root
# isikan password user untuk akses ke MySQL
password = 12345678
# isikan nama database untuk Gammu
database = klinikdb
