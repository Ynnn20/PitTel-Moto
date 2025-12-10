// assets/js/main.js
// PitTel Moto JavaScript Utilities

// Auto hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
    
    // Format currency inputs
    const currencyInputs = document.querySelectorAll('input[type="number"][step="1000"]');
    currencyInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value) {
                this.value = Math.round(this.value / 1000) * 1000;
            }
        });
    });
    
    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('a[href*="hapus.php"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Yakin ingin menghapus data ini? Tindakan tidak dapat dibatalkan!')) {
                e.preventDefault();
            }
        });
    });
});

// Real-time search function
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase();
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');
    
    let visibleCount = 0;
    
    for (let i = 1; i < tr.length; i++) {
        let txtValue = tr[i].textContent || tr[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
            visibleCount++;
        } else {
            tr[i].style.display = 'none';
        }
    }
    
    // Show "no results" message if needed
    if (visibleCount === 0 && filter !== '') {
        console.log('No results found');
    }
}

// Format number to Rupiah
function formatRupiah(number) {
    return 'Rp ' + number.toLocaleString('id-ID');
}

// Validate form before submit
function validateForm(formId) {
    const form = document.getElementById(formId);
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.style.borderColor = 'var(--primary-red)';
            isValid = false;
        } else {
            field.style.borderColor = 'var(--light-gray)';
        }
    });
    
    if (!isValid) {
        alert('Harap lengkapi semua field yang wajib diisi!');
    }
    
    return isValid;
}

// Show loading spinner
function showLoading() {
    const loader = document.createElement('div');
    loader.id = 'loading-spinner';
    loader.innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.8); color: white; padding: 2rem; border-radius: 10px; z-index: 9999;"><div style="font-size: 2rem;">⚙️</div><p>Loading...</p></div>';
    document.body.appendChild(loader);
}

function hideLoading() {
    const loader = document.getElementById('loading-spinner');
    if (loader) loader.remove();
}

console.log('🔥 PitTel Moto - Racing Grade Management System Ready! 🏍️');