<?php
/**
 * Plugin Name: AgendaiRS - ViaCEP Auto-fill
 * Description: Preenchimento automático de endereço para JetFormBuilder usando ViaCEP.
 * Version: 1.0
 * Author: Comércio do Site
 */

add_action('wp_footer', function() {
    ?>
    <script>
    document.addEventListener('change', function(e) {
        // Verifica se o campo alterado tem "cep" no nome ou ID
        if (e.target.name === 'cep' || e.target.id === 'cep') {
            let cep = e.target.value.replace(/\D/g, '');
            
            if (cep.length === 8) {
                // Seleciona os campos baseados nos nomes comuns do JetFormBuilder
                const campoRua = document.querySelector('[name="endereco"], [name="logradouro"]');
                const campoBairro = document.querySelector('[name="bairro"]');
                const campoCidade = document.querySelector('[name="cidade"]');
                const campoUF = document.querySelector('[name="estado"], [name="uf"]');

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.erro) {
                            if (campoRua) campoRua.value = data.logradouro;
                            if (campoBairro) campoBairro.value = data.bairro;
                            
                            // Se a cidade for um campo de texto
                            if (campoCidade && campoCidade.tagName === 'INPUT') {
                                campoCidade.value = data.localidade;
                            } 
                            // Se a cidade for um SELECT (tenta encontrar pelo texto)
                            else if (campoCidade && campoCidade.tagName === 'SELECT') {
                                Array.from(campoCidade.options).forEach(option => {
                                    if (option.text.toLowerCase() === data.localidade.toLowerCase()) {
                                        campoCidade.value = option.value;
                                    }
                                });
                            }
                            
                            if (campoUF) campoUF.value = data.uf;
                            
                            // Dispara evento de mudança para o JetFormBuilder validar os campos
                            [campoRua, campoBairro, campoCidade, campoUF].forEach(el => {
                                if(el) el.dispatchEvent(new Event('change', { bubbles: true }));
                            });
                        }
                    });
            }
        }
    });
    </script>
    <?php
});