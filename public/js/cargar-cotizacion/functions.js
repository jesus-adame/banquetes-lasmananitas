
function getSubtotal(d) {
   let precio = d.querySelector('.precio').value,
      cantidad = d.querySelector('.cantidad').value,
      subtotal = d.querySelector('.subtotal')
   result = precio * cantidad

   subtotal.value = result.toFixed(2)
}

function getTotal(subtotales) {
   res = 0;
   for (let i = 0; i < subtotales.length; i++) {
      res += parseFloat(subtotales[i].value)
   }
   return total_result = res.toFixed(2);
}

function getTotales(formData) {
   ajaxRequest('cotizacion', formData)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({ content: dataJson.msg })
      } else {
         if (dataJson.data.alimentos != null) {
            let totales = dataJson.data
            t_alimentos.innerHTML = '$ ' + totales.alimentos
            t_renta.innerHTML = '$ ' + totales.renta
            t_total.innerHTML = '$ ' + totales.total
         } else {
            t_alimentos.innerHTML = '$ 0.00'
            t_renta.innerHTML = '$ 0.00'
            t_total.innerHTML = '$ 0.00'
         }
      }
   })
}