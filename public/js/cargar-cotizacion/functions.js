
function getSubtotal(d) {
   let precio   = d.querySelector('.precio').value,
       cantidad = d.querySelector('.cantidad').value,
       subtotal = d.querySelector('.subtotal')

   result = precio * cantidad;
   subtotal.value = result.toLocaleString('en', formato_moneda);
}

function getTotal(subtotales) {
   res = 0;
   for (let i = 0; i < subtotales.length; i++) {
      let subtotal = parseFloat(subtotales[i].value.replace(/,/g, ''));

      res += subtotal
   }
   return total_result = res;
}

function getTotales(formData) {
   ajaxRequest('cotizacion', formData)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({ content: dataJson.msg })

      } else {
         if (dataJson.data.alimentos != null) {
            let totales   = dataJson.data,
                alimentos = parseFloat(totales.alimentos).toLocaleString('es-MX', formato_moneda),
                total     = parseFloat(totales.total).toLocaleString('es-MX', formato_moneda);

            t_alimentos.innerHTML = '<span>$</span>' + alimentos;
            t_total.innerHTML = '<span>$</span>' + total;

         } else {
            t_alimentos.innerHTML = '<span>$</span> 0.00';   
         }
      }
   })
}