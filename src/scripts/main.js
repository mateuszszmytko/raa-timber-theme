import { Karrot } from "@karrot/core";
import { FormAjax, FormValidation, ScrollTo } from '@karrot/common';

import { App } from "./app";

Karrot.init();
Karrot.attach('my-form', FormAjax, FormValidation);
Karrot.attach('link', ScrollTo);
Karrot.attach('app', App);

const form = Karrot.get('test-block');

console.log(form, 'hello world');

Karrot.attach('test-block', (el) => {
    console.log(el);
    el.addEventListener('click', () => {
        console.log('dsa');
    });
});

jQuery(() => {
    console.log('asd');
});
