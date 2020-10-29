// eslint-disable-next-line no-unused-vars
import { KarrotItem } from '@karrot/core';

export class Site {

    /**
     *Creates an instance of Site.
     * @param {KarrotItem} item
     * @memberof Site
     */
    constructor(item) {
        this.element = item.element;
    }

    kOnInit() {
        // eslint-disable-next-line no-console
        console.log('hello world', this.element);
    }
}
