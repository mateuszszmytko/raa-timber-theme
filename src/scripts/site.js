export class Site {

    /**
     *Creates an instance of Site.
     * @param {HTMLElement} element
     * @memberof Site
     */
    constructor(element) {
        this.element = element;
    }

    kOnInit() {
        // eslint-disable-next-line no-console
        console.log('hello world', this.element);
    }
}
