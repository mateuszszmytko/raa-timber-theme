import {  Karrot } from "@karrot/core";
import { FormAjax, FormValidation, ScrollTo } from '@karrot/common';

import { App } from "./app";

Karrot.init();
Karrot.attach('my-form', FormAjax, FormValidation);
Karrot.attach('link', ScrollTo);
Karrot.attach('app', App);

const form = Karrot.get('my-form');

console.log(form);
