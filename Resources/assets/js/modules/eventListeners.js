export function addDynamicChoiceSelect(element, emsForm) {
    element.addEventListener('change', function() {
        let token = document.getElementById('form__token');
        let elementId = this.getAttribute('id');
        let idPrefix = elementId.substr(0, elementId.lastIndexOf('_'));
        let ids = document.querySelectorAll('*[id^="' + idPrefix + '"]');

        let data = {};
        data[token.getAttribute('name')] = token.value;
        Array.from(ids).forEach(function(element) {
            data[element.getAttribute('name')] = element.value;
        });

        emsForm.onDynamicFieldChange(data);
    });
}

export function clickSendConfirmation(element, emsForm) {
    element.addEventListener('click', function () {
        let valueElement = document.getElementById(this.getAttribute('data-value-id'));

        emsForm.onSendConfirmation(JSON.stringify({
            'token': this.getAttribute('data-token'),
            'code-field': this.getAttribute('data-name'),
            'value': valueElement.value
        }));
    });
}
