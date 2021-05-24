"use strict";

module.exports = View;

function View(containerId) {

    if (!(this instanceof View)) {
        return new View(containerId);
    }

    this.render = render;
    this.setA = setA;
    this.getA = getA;
    this.setB = setB;
    this.getB = getB;
    this.setC = setC;
    this.getC = getC;
    this.setInputChangeHandler = setInputChangeHandler;
    this.update = update;

    const _container = tryGetContainer(containerId);
    const _inputsSelector = '.equation-form > .equation-form__input';
    const _inputASelector = '.equation-form #a';
    const _inputBSelector = '.equation-form #b';
    const _inputCSelector = '.equation-form #c';
    const _resultSelector = '.equation__result-container > .equation__result';

    /**
     * Get input by it's selector
     * @param selector
     * @returns {Element}
     */
    function getInputBy(selector) {
        const input = document.querySelector(selector);
        if (!input) {
            throw `Input ${selector} not found. Probably view is not rendered yet.`
        }
        return input;
    }

    /**
     * Create Layout
     * @returns {string}
     */
    function getLayout() {
        return layout;
    }

    /**
     * Renders view
     */
    function render() {
        if (!_container) {
            throw 'Cannot render view';
        }
        _container.innerHTML += getLayout();
    }

    /**
     * Reset text input change-event handler
     * @param callback
     */
    function setInputChangeHandler(callback) {
        if (typeof callback === 'function') {
            const inputs = document.querySelectorAll(_inputsSelector);
            for (const input of inputs) {
                input.addEventListener('input', callback);
            }
        }
    }

    /**
     * Try to get container
     *
     * @param componentClassId
     * @returns {*}
     */
    function tryGetContainer(componentClassId) {
        const component = document.querySelector(componentClassId);
        if (!component) {
            throw 'Component not found';
        }
        return component;
    }

    /**
     * Update result
     */
    function update(result) {
        getInputBy(_resultSelector).innerHTML = result.roots.join('; ');
    }


    /**
     * Get A
     */
    function getA() {
        return getInputBy(_inputASelector).value;
    }

    /**
     * Get B
     */
    function getB() {
        return getInputBy(_inputBSelector).value;
    }

    /**
     * Get C
     */
    function getC() {
        return getInputBy(_inputCSelector).value;
    }

    /**
     * Set A
     * @param a
     */
    function setA(a) {
        getInputBy(_inputASelector).value = a;
    }

    /**
     * Set B
     * @param b
     */
    function setB(b) {
        getInputBy(_inputBSelector).value = b;
    }

    /**
     * Set C
     * @param c
     */
    function setC(c) {
        getInputBy(_inputCSelector).value = c;
    }

    const layout = `
        <section class="equation">
            <div class="equation__inner">
                <form action="#" class="equation__form equation-form">
                    <input type="number" id="a" name="a" class="equation-form__input"><span class="equation-form__times">*</span>x<span class="equation-form__degree">2</span>
                    +<input type="number" id="b" name="b" class="equation-form__input"><span class="equation-form__times">*</span>x
                    +<input type="number" id="c" name="c" class="equation-form__input">
                    =0
                </form>
                <div class="equation__result-container">
                    Result: <span class="equation__result"></span>
                </div>
            </div>
        </section>
`;

}

