document.addEventListener('DOMContentLoaded', () => {
    initFaq();
});

document.addEventListener('livewire:navigated', () => {
    initFaq();
});

function initFaq() {
    const faqItems = document.querySelectorAll('[data-faq-item]');
    
    faqItems.forEach(item => {
        const trigger = item.querySelector('[data-faq-trigger]');
        const content = item.querySelector('[data-faq-content]');
        
        if (!trigger || !content) return;
        
        trigger.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
                const otherContent = otherItem.querySelector('[data-faq-content]');
                if (otherContent) {
                    otherContent.style.maxHeight = '0';
                }
            });
            
            if (!isActive) {
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
}
