"use strict";

module.exports = Model;

function Model() {

    if (!(this instanceof Model)) {
        return new Model();
    }

    this.getA = getA;
    this.setA = setA;
    this.getB = getB;
    this.setB = setB;
    this.getC = getC;
    this.setC = setC;
    this.getDiscriminant = getDiscriminant;
    this.getResult = getResult;
    this.getRoots = getRoots;

    let _a = 1;
    let _b = 1;
    let _c = 1;

    /**
     * Return discriminant
     */
    function getDiscriminant() {
        return Math.pow(this.getB(), 2) - 4 * this.getA() * this.getC();
    }

    /**
     * Get roots
     */
    function getRoots() {
        const discriminant = this.getDiscriminant();
        if (+discriminant < 0) {
            return ["No roots"];
        }
        if (+this.getA() === 0) {
            return ["coefficient at x2 must not be equal to 0"];
        }
        return [
            (-1 * this.getB() + Math.sqrt(discriminant)) / (2 * this.getA()),
            (-1 * this.getB() - Math.sqrt(discriminant)) / (2 * this.getA())
        ];
    }

    /**
     * 
     */
    function getResult() {
        return {
            discriminant: this.getDiscriminant(),
            roots: this.getRoots()
        }
    }

    /**
     * Return A
     */
    function getA() {
        return _a;
    }

    /**
     * Set A
     * @param a
     */
    function setA(a) {
        _a = +a;
    }

    /**
     * Return B
     */
    function getB() {
        return _b;
    }

    /**
     * Set B
     * @param b
     */
    function setB(b) {
        _b = +b;
    }

    /**
     * Return C
     */
    function getC() {
        return _c;
    }

    /**
     * Set C
     * @param c
     */
    function setC(c) {
        _c = +c;
    }

}

