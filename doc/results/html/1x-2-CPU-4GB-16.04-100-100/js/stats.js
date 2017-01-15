var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "10100",
        "ok": "6641",
        "ko": "3459"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "7",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "33984",
        "ok": "33984",
        "ko": "30925"
    },
    "meanResponseTime": {
        "total": "9101",
        "ok": "13793",
        "ko": "91"
    },
    "standardDeviation": {
        "total": "11029",
        "ok": "10938",
        "ko": "1438"
    },
    "percentiles1": {
        "total": "1819",
        "ok": "13659",
        "ko": "1"
    },
    "percentiles2": {
        "total": "19938",
        "ok": "24704",
        "ko": "2"
    },
    "percentiles3": {
        "total": "28570",
        "ok": "29374",
        "ko": "3"
    },
    "percentiles4": {
        "total": "31063",
        "ok": "31670",
        "ko": "6"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1245,
        "percentage": 12
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 13,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 5383,
        "percentage": 53
    },
    "group4": {
        "name": "failed",
        "count": 3459,
        "percentage": 34
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "70.629",
        "ok": "46.441",
        "ko": "24.189"
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
        "total": "5050",
        "ok": "3398",
        "ko": "1652"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "7",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "32477",
        "ok": "32477",
        "ko": "19987"
    },
    "meanResponseTime": {
        "total": "8430",
        "ok": "12522",
        "ko": "14"
    },
    "standardDeviation": {
        "total": "10421",
        "ok": "10492",
        "ko": "492"
    },
    "percentiles1": {
        "total": "1784",
        "ok": "11037",
        "ko": "1"
    },
    "percentiles2": {
        "total": "17405",
        "ok": "23397",
        "ko": "2"
    },
    "percentiles3": {
        "total": "27790",
        "ok": "28535",
        "ko": "3"
    },
    "percentiles4": {
        "total": "30110",
        "ok": "30389",
        "ko": "5"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 656,
        "percentage": 13
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 10,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 2732,
        "percentage": 54
    },
    "group4": {
        "name": "failed",
        "count": 1652,
        "percentage": 33
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "35.315",
        "ok": "23.762",
        "ko": "11.552"
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
        "total": "5050",
        "ok": "3243",
        "ko": "1807"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "13",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "33984",
        "ok": "33984",
        "ko": "30925"
    },
    "meanResponseTime": {
        "total": "9771",
        "ok": "15125",
        "ko": "162"
    },
    "standardDeviation": {
        "total": "11568",
        "ok": "11233",
        "ko": "1930"
    },
    "percentiles1": {
        "total": "1847",
        "ok": "16589",
        "ko": "1"
    },
    "percentiles2": {
        "total": "22270",
        "ok": "25832",
        "ko": "1"
    },
    "percentiles3": {
        "total": "29234",
        "ok": "30224",
        "ko": "2"
    },
    "percentiles4": {
        "total": "31937",
        "ok": "32454",
        "ko": "15"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 589,
        "percentage": 12
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 3,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 2651,
        "percentage": 52
    },
    "group4": {
        "name": "failed",
        "count": 1807,
        "percentage": 36
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "35.315",
        "ok": "22.678",
        "ko": "12.636"
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
