export function formatPrice(amount, options = {}) {
    const {
      currency = 'MXN',
      minimumFractionDigits = 2,
      maximumFractionDigits = 2,
      showSymbol = true,
    } = options;
  
    if (amount === null || amount === undefined || isNaN(amount)) return '';
  
    const formatter = new Intl.NumberFormat('es-MX', {
      style: showSymbol ? 'currency' : 'decimal',
      currency,
      minimumFractionDigits,
      maximumFractionDigits,
    });
  
    return formatter.format(amount);
  }