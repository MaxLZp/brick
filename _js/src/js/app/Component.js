"use strict";

const Model = require('./Model');
const View = require('./View');

module.exports = Component;

function Component(container) {

    if (!(this instanceof Component)) {
        return new Component(container);
    }

    const _model = new Model();
    const _view = new View(container);

    (function init() {
        _view.render();
        _view.setInputChangeHandler(onInputChanged);
        _view.setA(_model.getA());
        _view.setB(_model.getB());
        _view.setC(_model.getC());
        updateView();
    })();

    /**
     * View's input change event handler
     * @param event
     */
    function onInputChanged(event) {
        _model.setA(_view.getA());
        _model.setB(_view.getB());
        _model.setC(_view.getC());
        updateView();
    }

    /**
     * UpdateView
     */
    function updateView() {
        _view.update(_model.getResult());
    }

}

