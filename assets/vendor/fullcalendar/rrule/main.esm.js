/*!
FullCalendar RRule Plugin v4.3.0
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/

import { rrulestr, RRule } from 'rrule';
import { createPlugin, refineProps, createDuration } from '@fullcalendar/core';

/*! *****************************************************************************
Copyright (c) Microsoft Corporation. All rights reserved.
Licensed under the Apache License, Version 2.0 (the "License"); you may not use
this file except in compliance with the License. You may obtain a copy of the
License at http://www.apache.org/licenses/LICENSE-2.0

THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
MERCHANTABLITY OR NON-INFRINGEMENT.

See the Apache Version 2.0 License for specific language governing permissions
and limitations under the License.
***************************************************************************** */

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};

var EVENT_DEF_PROPS = {
    rrule: null,
    duration: createDuration
};
var recurring = {
    parse: function (rawEvent, leftoverProps, dateEnv) {
        if (rawEvent.rrule != null) {
            var props = refineProps(rawEvent, EVENT_DEF_PROPS, {}, leftoverProps);
            var parsed = parseRRule(props.rrule, dateEnv);
            if (parsed) {
                return {
                    typeData: parsed.rrule,
                    allDayGuess: parsed.allDayGuess,
                    duration: props.duration
                };
            }
        }
        return null;
    },
    expand: function (rrule, framingRange) {
        // we WANT an inclusive start and in exclusive end, but the js rrule lib will only do either BOTH
        // inclusive or BOTH exclusive, which is stupid: https://github.com/jakubroztocil/rrule/issues/84
        // Workaround: make inclusive, which will generate extra occurences, and then trim.
        return rrule.between(framingRange.start, framingRange.end, true)
            .filter(function (date) {
            return date.valueOf() < framingRange.end.valueOf();
        });
    }
};
var main = createPlugin({
    recurringTypes: [recurring]
});
function parseRRule(input, dateEnv) {
    var allDayGuess = null;
    var rrule;
    if (typeof input === 'string') {
        rrule = rrulestr(input);
    }
    else if (typeof input === 'object' && input) { // non-null object
        var refined = __assign({}, input); // copy
        if (typeof refined.dtstart === 'string') {
            var dtstartMeta = dateEnv.createMarkerMeta(refined.dtstart);
            if (dtstartMeta) {
                refined.dtstart = dtstartMeta.marker;
                allDayGuess = dtstartMeta.isTimeUnspecified;
            }
            else {
                delete refined.dtstart;
            }
        }
        if (typeof refined.until === 'string') {
            refined.until = dateEnv.createMarker(refined.until);
        }
        if (refined.freq != null) {
            refined.freq = convertConstant(refined.freq);
        }
        if (refined.wkst != null) {
            refined.wkst = convertConstant(refined.wkst);
        }
        else {
            refined.wkst = (dateEnv.weekDow - 1 + 7) % 7; // convert Sunday-first to Monday-first
        }
        if (refined.byweekday != null) {
            refined.byweekday = convertConstants(refined.byweekday); // the plural version
        }
        rrule = new RRule(refined);
    }
    if (rrule) {
        return { rrule: rrule, allDayGuess: allDayGuess };
    }
    return null;
}
function convertConstants(input) {
    if (Array.isArray(input)) {
        return input.map(convertConstant);
    }
    return convertConstant(input);
}
function convertConstant(input) {
    if (typeof input === 'string') {
        return RRule[input.toUpperCase()];
    }
    return input;
}

export default main;
