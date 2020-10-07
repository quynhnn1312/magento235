/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

define([
    'SU_Blog/js/components/new-tag'
], function (Select) {
    'use strict';

    return Select.extend({

        /**
         * Normalize option object.
         *
         * @param {Object} data - Option object.
         * @returns {Object}
         */
        parseData: function (data) {
            return {
                'status': data.model['status'],
                level: data.model['level'],
                value: data.model['entity_id'],
                label: data.model['name'],
                parent: data.model['parent_id']
            };
        }
    });
});
