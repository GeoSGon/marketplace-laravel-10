let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand =  document.querySelector('span.brand');

cardNumber.addEventListener('keyup', () => {
    if (cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
        cardBin: cardNumber.value.substr(0, 6),
        success: (res) => {
            let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.name.brand}.png">`
            spanBrand.innerHTML = imgFlag;

            document.querySelector('input[name=card_brand]').value = res.brand.name;

            getInstallments(amountTransaction, res.brand.name);
        },
        error: (err) => {
            console.log(err);
        }
        });
    }   
});

let  submitButton = document.querySelector('button.processCheckout');

submitButton.addEventListener('click', (event) => {
    event.preventDefault();
    document.querySelector('div.msg').innerHTML = '';
    
    let buttonTarget = event.target;

    buttonTarget.disabled = true;
    event.target.innerHTML = 'Carregando...';

    PagSeguroDirectPayment.createCardtoken({
        cardNumber: document.querySelector('input[name=card_number]').value,
        brand: document.querySelector('input[name=card_brand]').value,
        cvv: document.querySelector('input[name=card_cvv]').value,
        expirationMonth: document.querySelector('input[name=card_month]').value,
        expirationYear: document.querySelector('input[name=card_year]').value,
        success: (res) => {
            processPayment(res.card.token, buttonTarget)
        },
        error: (err) => {
            buttonTarget.disabled = false;
            buttonTarget.innerHTML = 'Efetuar Pagamento';

            for(let i in err.errors) {
                document.querySelector('div.msg').innerHTML = errorMessages(errorsMapPagseguro(i));
            }
        }
    })
})