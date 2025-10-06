document.addEventListener('DOMContentLoaded', function () {
    const copyButton = document.getElementById('copyPixButton');
    const chavePixInput = document.getElementById('chavePix');

    if (copyButton && chavePixInput) {
        copyButton.addEventListener('click', function () {
            // Seleciona o texto do input
            chavePixInput.select();
            chavePixInput.setSelectionRange(0, 99999); // Para mobile

            // Copia o texto para a área de transferência
            navigator.clipboard.writeText(chavePixInput.value).then(function () {
                // Feedback visual
                const originalText = copyButton.innerHTML;
                copyButton.innerHTML = '<i class="bi bi-check-lg"></i> Copiado!';
                copyButton.style.backgroundColor = 'var(--color-success)';
                copyButton.style.borderColor = 'var(--color-success)';

                setTimeout(() => {
                    copyButton.innerHTML = originalText;
                    copyButton.style.backgroundColor = 'var(--color-primary)';
                    copyButton.style.borderColor = 'var(--color-primary)';
                }, 2000); // Volta ao normal após 2 segundos
            }).catch(err => {
                console.error('Erro ao copiar a chave Pix:', err);
                alert('Erro ao copiar. Por favor, tente novamente ou copie manualmente.');
            });
        });
    }
});