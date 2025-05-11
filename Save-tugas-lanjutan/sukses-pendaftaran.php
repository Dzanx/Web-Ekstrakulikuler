<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Pendaftaran Berhasil</title>
  <link rel="stylesheet" href="styles/stlye.css">
  <style>
    /* Modern and attractive styles for the registration success page */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 2rem;
  color: #333;
}

.success-container {
  background-color: white;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  padding: 3rem;
  max-width: 600px;
  width: 90%;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.success-container::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, #00C853, #B2FF59);
}

h1 {
  color: #2E7D32;
  margin-bottom: 1.5rem;
  font-weight: 700;
  font-size: 2.2rem;
  position: relative;
  display: inline-block;
}

h1::after {
  content: "";
  position: absolute;
  bottom: -8px;
  left: 50%;
  transform: translateX(-50%);
  width: 70%;
  height: 3px;
  background-color: #2E7D32;
  border-radius: 2px;
}

p {
  margin-bottom: 1.5rem;
  font-size: 1.1rem;
  line-height: 1.6;
  color: #555;
}

a {
  display: inline-block;
  background-color: #2E7D32;
  color: white;
  text-decoration: none;
  padding: 0.8rem 1.5rem;
  border-radius: 50px;
  font-weight: 600;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
  margin-top: 0.5rem;
  box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
}

a:hover {
  background-color: #1B5E20;
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(46, 125, 50, 0.3);
}

.success-icon {
  display: block;
  margin: 0 auto 1.5rem auto;
  font-size: 4rem;
  color: #2E7D32;
}

/* Animation for the success icon */
@keyframes bounceIn {
  0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
  40% {transform: translateY(-20px);}
  60% {transform: translateY(-10px);}
}

.animate-success {
  animation: bounceIn 1s;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .success-container {
    padding: 2rem;
  }
  
  h1 {
    font-size: 1.8rem;
  }
  
  p {
    font-size: 1rem;
  }
}
  </style>
</head>
<body>
  <h1>Pendaftaran Berhasil!</h1>
  <p>Terima kasih, pendaftaran Anda telah disimpan.</p>
  <p><a href="ekskul.html">Kembali ke Daftar Ekstrakurikuler</a></p>
</body>
</html>