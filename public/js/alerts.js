// سیستم اعلانات مشترک
class AlertManager {
    constructor() {
        this.alerts = [];
        this.init();
    }

    init() {
        // نمایش اعلانات موجود در صفحه
        this.showExistingAlerts();
        
        // تنظیم event listener برای بستن اعلانات
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('alert-close')) {
                this.dismissAlert(e.target.closest('.custom-alert'));
            }
        });
    }

    showExistingAlerts() {
        const alerts = document.querySelectorAll('.custom-alert');
        alerts.forEach(alert => {
            this.showAlert(alert);
        });
    }

    showAlert(alertElement) {
        if (!alertElement) return;
        
        alertElement.style.display = 'block';
        this.alerts.push(alertElement);
        
        // بعد از 5 ثانیه، اعلان به تدریج ناپدید می‌شود
        setTimeout(() => {
            this.dismissAlert(alertElement);
        }, 5000);
    }

    dismissAlert(alertElement) {
        if (!alertElement) return;
        
        alertElement.classList.add('fade-out');
        setTimeout(() => {
            alertElement.style.display = 'none';
            this.alerts = this.alerts.filter(alert => alert !== alertElement);
        }, 500);
    }

    // ایجاد اعلان جدید
    createAlert(type, message, duration = 5000) {
        const alertId = 'alert-' + Date.now();
        const alertHtml = `
            <div class="custom-alert ${type}" id="${alertId}">
                <div class="alert-content">
                    <div class="alert-icon">
                        <i class="fas ${this.getIconClass(type)}"></i>
                    </div>
                    <div class="alert-message">${message}</div>
                    <button class="alert-close" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        
        // اضافه کردن به ابتدای body
        document.body.insertAdjacentHTML('afterbegin', alertHtml);
        
        const alertElement = document.getElementById(alertId);
        this.showAlert(alertElement);
        
        return alertElement;
    }

    getIconClass(type) {
        const icons = {
            'success': 'fa-check-circle',
            'error': 'fa-exclamation-circle',
            'warning': 'fa-exclamation-triangle',
            'info': 'fa-info-circle'
        };
        return icons[type] || icons['info'];
    }

    // متدهای راحتی
    success(message, duration) {
        return this.createAlert('success', message, duration);
    }

    error(message, duration) {
        return this.createAlert('error', message, duration);
    }

    warning(message, duration) {
        return this.createAlert('warning', message, duration);
    }

    info(message, duration) {
        return this.createAlert('info', message, duration);
    }

    // بستن همه اعلانات
    dismissAll() {
        this.alerts.forEach(alert => {
            this.dismissAlert(alert);
        });
    }
}

// ایجاد instance سراسری
window.alertManager = new AlertManager();

// تابع‌های راحتی سراسری
window.showSuccess = (message, duration) => window.alertManager.success(message, duration);
window.showError = (message, duration) => window.alertManager.error(message, duration);
window.showWarning = (message, duration) => window.alertManager.warning(message, duration);
window.showInfo = (message, duration) => window.alertManager.info(message, duration);
