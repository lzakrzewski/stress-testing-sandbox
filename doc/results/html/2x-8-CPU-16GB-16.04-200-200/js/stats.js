var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "40200",
        "ok": "28000",
        "ko": "12200"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "13",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "21024",
        "ok": "21024",
        "ko": "11537"
    },
    "meanResponseTime": {
        "total": "4122",
        "ok": "5334",
        "ko": "1340"
    },
    "standardDeviation": {
        "total": "4146",
        "ok": "4041",
        "ko": "2840"
    },
    "percentiles1": {
        "total": "2165",
        "ok": "6231",
        "ko": "25"
    },
    "percentiles2": {
        "total": "8541",
        "ok": "9060",
        "ko": "72"
    },
    "percentiles3": {
        "total": "10327",
        "ok": "10622",
        "ko": "8226"
    },
    "percentiles4": {
        "total": "11513",
        "ok": "11731",
        "ko": "9408"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 3786,
        "percentage": 9
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 1233,
        "percentage": 3
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 22981,
        "percentage": 57
    },
    "group4": {
        "name": "failed",
        "count": 12200,
        "percentage": 30
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "186.977",
        "ok": "130.233",
        "ko": "56.744"
    }
},
contents: {
"req_wall-94e8a": {
        type: "REQUEST",
        name: "Wall",
path: "Wall",
pathFormatted: "req_wall-94e8a",
stats: {
    "name": "Wall",
    "numberOfRequests": {
        "total": "20100",
        "ok": "14070",
        "ko": "6030"
    },
    "minResponseTime": {
        "total": "1",
        "ok": "13",
        "ko": "1"
    },
    "maxResponseTime": {
        "total": "14668",
        "ok": "14668",
        "ko": "11537"
    },
    "meanResponseTime": {
        "total": "3831",
        "ok": "4932",
        "ko": "1263"
    },
    "standardDeviation": {
        "total": "3950",
        "ok": "3911",
        "ko": "2624"
    },
    "percentiles1": {
        "total": "1716",
        "ok": "5679",
        "ko": "33"
    },
    "percentiles2": {
        "total": "8160",
        "ok": "8658",
        "ko": "223"
    },
    "percentiles3": {
        "total": "9676",
        "ok": "9906",
        "ko": "7594"
    },
    "percentiles4": {
        "total": "10835",
        "ok": "11031",
        "ko": "8445"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 2591,
        "percentage": 13
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 523,
        "percentage": 3
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 10956,
        "percentage": 55
    },
    "group4": {
        "name": "failed",
        "count": 6030,
        "percentage": 30
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "93.488",
        "ok": "65.442",
        "ko": "28.047"
    }
}
    },"req_publishpost-28274": {
        type: "REQUEST",
        name: "PublishPost",
path: "PublishPost",
pathFormatted: "req_publishpost-28274",
stats: {
    "name": "PublishPost",
    "numberOfRequests": {
        "total": "20100",
        "ok": "13930",
        "ko": "6170"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "32",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "21024",
        "ok": "21024",
        "ko": "10939"
    },
    "meanResponseTime": {
        "total": "4412",
        "ok": "5739",
        "ko": "1415"
    },
    "standardDeviation": {
        "total": "4315",
        "ok": "4128",
        "ko": "3034"
    },
    "percentiles1": {
        "total": "2660",
        "ok": "6580",
        "ko": "19"
    },
    "percentiles2": {
        "total": "9007",
        "ok": "9503",
        "ko": "45"
    },
    "percentiles3": {
        "total": "10734",
        "ok": "11039",
        "ko": "8721"
    },
    "percentiles4": {
        "total": "11871",
        "ok": "12068",
        "ko": "9803"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1195,
        "percentage": 6
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 710,
        "percentage": 4
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 12025,
        "percentage": 60
    },
    "group4": {
        "name": "failed",
        "count": 6170,
        "percentage": 31
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "93.488",
        "ok": "64.791",
        "ko": "28.698"
    }
}
    }
}

}

function fillStats(stat){
    $("#numberOfRequests").append(stat.numberOfRequests.total);
    $("#numberOfRequestsOK").append(stat.numberOfRequests.ok);
    $("#numberOfRequestsKO").append(stat.numberOfRequests.ko);

    $("#minResponseTime").append(stat.minResponseTime.total);
    $("#minResponseTimeOK").append(stat.minResponseTime.ok);
    $("#minResponseTimeKO").append(stat.minResponseTime.ko);

    $("#maxResponseTime").append(stat.maxResponseTime.total);
    $("#maxResponseTimeOK").append(stat.maxResponseTime.ok);
    $("#maxResponseTimeKO").append(stat.maxResponseTime.ko);

    $("#meanResponseTime").append(stat.meanResponseTime.total);
    $("#meanResponseTimeOK").append(stat.meanResponseTime.ok);
    $("#meanResponseTimeKO").append(stat.meanResponseTime.ko);

    $("#standardDeviation").append(stat.standardDeviation.total);
    $("#standardDeviationOK").append(stat.standardDeviation.ok);
    $("#standardDeviationKO").append(stat.standardDeviation.ko);

    $("#percentiles1").append(stat.percentiles1.total);
    $("#percentiles1OK").append(stat.percentiles1.ok);
    $("#percentiles1KO").append(stat.percentiles1.ko);

    $("#percentiles2").append(stat.percentiles2.total);
    $("#percentiles2OK").append(stat.percentiles2.ok);
    $("#percentiles2KO").append(stat.percentiles2.ko);

    $("#percentiles3").append(stat.percentiles3.total);
    $("#percentiles3OK").append(stat.percentiles3.ok);
    $("#percentiles3KO").append(stat.percentiles3.ko);

    $("#percentiles4").append(stat.percentiles4.total);
    $("#percentiles4OK").append(stat.percentiles4.ok);
    $("#percentiles4KO").append(stat.percentiles4.ko);

    $("#meanNumberOfRequestsPerSecond").append(stat.meanNumberOfRequestsPerSecond.total);
    $("#meanNumberOfRequestsPerSecondOK").append(stat.meanNumberOfRequestsPerSecond.ok);
    $("#meanNumberOfRequestsPerSecondKO").append(stat.meanNumberOfRequestsPerSecond.ko);
}
