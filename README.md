ct519 MyContact

การออกแบบหลักการออกแบบ
ใช้php และฐานข้อมูลเป็น phpmyadminใช้ cloud Aws docker แบ่งเป็น frontend และ backend แยก container กัน ส่วน cloud ที่ใช้ deploy นั้นจะเป็น aws ec2
การเตรียมการระบบ Cloud
ใช้ ec2 โดยใช้ awsในการทำ และ install docker และ git เพื่อ clone data มา deploy
การ deploy ตัว code มาทำงาน
- สร้างเว็บให้เรียบร้อย พร้อมทั้ง dockerfile กับ docker-compose.yaml
-เตรียม git ให้พร้อม
-สร้าง repositories 
-อัพโหลด repositories 
-Awsทำการ install docker engine ให้เรียบร้อย
-Awsทำการinstall docker compose ให้เรียบร้อย
-ใน command line git clone https://github.com/Migky/teerawat
-chmod -R 777 all file and folder
-docker-compose up --build
