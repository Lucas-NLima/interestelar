const canvas = document.getElementById("starfield");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

window.addEventListener("resize", () => {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
});

// ---------------- Estrelas ----------------
const stars = [];
const numStars = 120;

for (let i = 0; i < numStars; i++) {
  stars.push({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    radius: 1 + Math.random() * 2,
    dx: (Math.random() - 0.5) * 0.5,
    dy: (Math.random() - 0.5) * 0.5
  });
}


// ---------------- Planetas em órbita (com imagens) ----------------
const planets = [
  {
    centerX: canvas.width / 2,
    centerY: canvas.height / 2,
    orbitRadius: 200,
    radius: 40,
    angle: Math.random() * Math.PI * 2,
    speed: 0.002,
    img: loadImage("img/terra.png")
  },
  {
    centerX: canvas.width / 2,
    centerY: canvas.height / 2,
    orbitRadius: 350,
    radius: 60,
    angle: Math.random() * Math.PI * 2,
    speed: 0.0015,
    img: loadImage("img/marte.png")
  },
  {
    centerX: canvas.width / 2,
    centerY: canvas.height / 2,
    orbitRadius: 500,
    radius: 50,
    angle: Math.random() * Math.PI * 2,
    speed: 0.001,
    img: loadImage("img/jupiter.png")
  }
];

// Função para carregar imagens
function loadImage(src) {
  const img = new Image();
  img.src = src;
  return img;
}



// ---------------- Estrelas cadentes ----------------
let shootingStars = [];

function createShootingStar() {
  shootingStars.push({
    x: Math.random() * canvas.width,
    y: 0,
    length: 200,
    speed: 8 + Math.random() * 4,
    angle: Math.PI / 4,
    opacity: 1
  });
}

setInterval(() => {
  if (Math.random() > 0.5) createShootingStar();
}, 2000);

// ---------------- Mouse ----------------
const mouse = { x: null, y: null };
window.addEventListener("mousemove", e => {
  mouse.x = e.x;
  mouse.y = e.y;
});

// ---------------- Animação ----------------
function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Planetas em órbita
  
  // Planetas em órbita (com imagens)
planets.forEach(p => {
  p.angle += p.speed;
  const x = p.centerX + p.orbitRadius * Math.cos(p.angle);
  const y = p.centerY + p.orbitRadius * Math.sin(p.angle);

  if (p.img.complete) { // só desenha quando a imagem carregar
    ctx.drawImage(p.img, x - p.radius, y - p.radius, p.radius * 2, p.radius * 2);
  }
});


  // Estrelas normais
  for (let i = 0; i < numStars; i++) {
    const s = stars[i];

    ctx.beginPath();
    ctx.arc(s.x, s.y, s.radius, 0, Math.PI * 2);
    ctx.fillStyle = "white";
    ctx.fill();

    s.x += s.dx;
    s.y += s.dy;

    if (s.x < 0 || s.x > canvas.width) s.dx *= -1;
    if (s.y < 0 || s.y > canvas.height) s.dy *= -1;
  }

  // Conexões entre estrelas
  for (let i = 0; i < numStars; i++) {
    for (let j = i + 1; j < numStars; j++) {
      const dx = stars[i].x - stars[j].x;
      const dy = stars[i].y - stars[j].y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      if (dist < 120) {
        ctx.beginPath();
        ctx.moveTo(stars[i].x, stars[i].y);
        ctx.lineTo(stars[j].x, stars[j].y);
        ctx.strokeStyle = "rgba(255,255,255,0.1)";
        ctx.stroke();
      }
    }

    if (mouse.x && mouse.y) {
      const dx = stars[i].x - mouse.x;
      const dy = stars[i].y - mouse.y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      if (dist < 150) {
        ctx.beginPath();
        ctx.moveTo(stars[i].x, stars[i].y);
        ctx.lineTo(mouse.x, mouse.y);
        ctx.strokeStyle = "rgba(255,255,255,0.2)";
        ctx.stroke();
      }
    }
  }

  // Estrelas cadentes
  for (let i = 0; i < shootingStars.length; i++) {
    let s = shootingStars[i];
    ctx.beginPath();
    ctx.moveTo(s.x, s.y);
    ctx.lineTo(
      s.x - s.length * Math.cos(s.angle),
      s.y - s.length * Math.sin(s.angle)
    );
    ctx.strokeStyle = `rgba(255,255,255,${s.opacity})`;
    ctx.lineWidth = 2;
    ctx.stroke();

    s.x += s.speed * Math.cos(s.angle);
    s.y += s.speed * Math.sin(s.angle);
    s.opacity -= 0.01;

    if (s.opacity <= 0) {
      shootingStars.splice(i, 1);
      i--;
    }
  }

  requestAnimationFrame(animate);
}

animate();