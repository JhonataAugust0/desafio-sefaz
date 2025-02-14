<template>
    <footer class="w-full py-5 mt-auto border-t border-gray-200 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <div class="flex items-center space-x-4">
            <span class="text-primary font-medium">MczIn</span>
            <a
              href="/termos"
              class="text-gray-600 hover:text-primary transition-colors text-sm"
            >
              Termos de Uso
            </a>
            <a
              href="/politica-privacidade"
              class="text-gray-600 hover:text-primary transition-colors text-sm"
            >
              Política de Privacidade
            </a>
            <a
              href="https://www.linkedin.com/in/jhonata-augusto/"
              class="text-gray-600 hover:text-primary transition-colors text-sm"
              target="_blank"
              rel="noopener noreferrer"
            >
              Time de desenvolvimento
            </a>
          </div>
          <div class="text-sm text-gray-500">
            © {{ new Date().getFullYear() }} Secretaria Municipal da Fazenda de Maceió - Todos os direitos reservados
          </div>
        </div>
      </div>
    </footer>
  </template>
