#!/bin/bash
# MF My Financial - Scripts Úteis

echo "╔═══════════════════════════════════════════════════════════════════╗"
echo "║              MF My Financial - Development Server                ║"
echo "╚═══════════════════════════════════════════════════════════════════╝"
echo ""

# Parar todos os servidores PHP
pkill -f "php.*-S" 2>/dev/null
pkill -f "php.*serve" 2>/dev/null

# Ir para o diretório do projeto
cd /home/dg/projects/meu_financeiro

echo "🔧 Limpando caches..."
php artisan optimize:clear > /dev/null 2>&1

echo "📦 Compilando assets (se necessário)..."
if [ ! -d "public/build" ] || [ -z "$(ls -A public/build)" ]; then
    npm run build
fi

echo ""
echo "🚀 Iniciando servidor PHP na porta 9000..."
php -S localhost:9000 -t public > /dev/null 2>&1 &
SERVER_PID=$!

sleep 2

echo ""
echo "✅ Servidor iniciado com sucesso!"
echo ""
echo "╔═══════════════════════════════════════════════════════════════════╗"
echo "║  🌐 ACESSE:  http://localhost:9000                                ║"
echo "╠═══════════════════════════════════════════════════════════════════╣"
echo "║  📄 Página Home:         http://localhost:9000                    ║"
echo "║  📊 Plano de Contas:     http://localhost:9000/financeiro/plano-contas ║"
echo "╠═══════════════════════════════════════════════════════════════════╣"
echo "║  🗄️  Database: meu_financeiro                                      ║"
echo "║  👤 User: mf_user / Pass: mf_pass                                 ║"
echo "║  📈 Contas cadastradas: 71                                        ║"
echo "╚═══════════════════════════════════════════════════════════════════╝"
echo ""
echo "Para parar o servidor: pkill -f 'php.*-S'"
echo ""

