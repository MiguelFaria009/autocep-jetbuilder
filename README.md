# AgendaiRS - ViaCEP Auto-fill para JetFormBuilder

O **AgendaiRS - ViaCEP Auto-fill** é um plugin leve e eficiente para WordPress, projetado especificamente para integrar a API do ViaCEP aos formulários criados com o **JetFormBuilder**. Ele automatiza o preenchimento de endereço, melhorando a conversão e a experiência do usuário (UX).

---

## ✨ Funcionalidades

* **Busca Automática:** Consulta os dados de endereço assim que o usuário digita os 8 dígitos do CEP.
* **Preenchimento Inteligente:** Autocompleta Logradouro, Bairro, Cidade e UF.
* **Compatibilidade com Selects:** Capaz de identificar e selecionar a cidade correta mesmo em campos do tipo `select`.
* **Sincronização com JetFormBuilder:** Dispara eventos nativos de JavaScript (`change`) para garantir que as validações do formulário reconheçam os novos dados.
* **Zero Configuração:** Basta instalar e garantir que os nomes dos campos (names/IDs) coincidam.

---

## 🚀 Como Instalar

1.  Faça o download deste repositório como um arquivo `.zip`.
2.  No painel do WordPress, vá em **Plugins > Adicionar Novo**.
3.  Clique em **Enviar Plugin** e selecione o arquivo baixado.
4.  Clique em **Instalar Agora** e depois em **Ativar**.

---

## 🛠️ Requisitos de Configuração

Para que o mapeamento funcione, os campos no seu formulário do **JetFormBuilder** devem usar os seguintes nomes (Atributo `name`) ou IDs:

| Campo | Atributos Aceitos (name ou ID) |
| :--- | :--- |
| **CEP** | `cep` |
| **Logradouro** | `endereco` ou `logradouro` |
| **Bairro** | `bairro` |
| **Cidade** | `cidade` |
| **Estado (UF)** | `estado` ou `uf` |

---

## 💻 Detalhes Técnicos

O plugin utiliza **Vanilla JavaScript** (sem necessidade de jQuery) e a função `fetch` para realizar requisições assíncronas à API do ViaCEP. A lógica está encapsulada no hook `wp_footer`, garantindo que o script seja carregado de forma otimizada no final da página.

### Exemplo de Fluxo:
1.  O script monitora o campo com `name="cep"`.
2.  Ao detectar 8 dígitos, remove caracteres não numéricos.
3.  Consulta `https://viacep.com.br/ws/${cep}/json/`.
4.  Distribui os dados nos campos correspondentes e força a atualização do estado do formulário.

---

## 📄 Licença

Este projeto é software livre e pode ser utilizado de acordo com os termos da licença MIT.

---
**Desenvolvido por:** Miguel Faria (Comércio do Site)
