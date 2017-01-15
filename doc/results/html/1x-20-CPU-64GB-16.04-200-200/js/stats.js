var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "40200",
        "ok": "32050",
        "ko": "8150"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "12",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "34884",
        "ok": "34884",
        "ko": "13742"
    },
    "meanResponseTime": {
        "total": "5423",
        "ok": "6787",
        "ko": "58"
    },
    "standardDeviation": {
        "total": "6375",
        "ok": "6456",
        "ko": "655"
    },
    "percentiles1": {
        "total": "2660",
        "ok": "4970",
        "ko": "0"
    },
    "percentiles2": {
        "total": "8936",
        "ok": "11385",
        "ko": "0"
    },
    "percentiles3": {
        "total": "18565",
        "ok": "19120",
        "ko": "0"
    },
    "percentiles4": {
        "total": "21612",
        "ok": "21880",
        "ko": "904"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 4135,
        "percentage": 10
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 834,
        "percentage": 2
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 27081,
        "percentage": 67
    },
    "group4": {
        "name": "failed",
        "count": 8150,
        "percentage": 20
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "153.435",
        "ok": "122.328",
        "ko": "31.107"
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
        "ok": "16354",
        "ko": "3746"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "12",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "17018",
        "ok": "17018",
        "ko": "10620"
    },
    "meanResponseTime": {
        "total": "2893",
        "ok": "3550",
        "ko": "24"
    },
    "standardDeviation": {
        "total": "2962",
        "ok": "2906",
        "ko": "288"
    },
    "percentiles1": {
        "total": "1920",
        "ok": "3350",
        "ko": "0"
    },
    "percentiles2": {
        "total": "5183",
        "ok": "5674",
        "ko": "0"
    },
    "percentiles3": {
        "total": "8254",
        "ok": "8565",
        "ko": "0"
    },
    "percentiles4": {
        "total": "10578",
        "ok": "10800",
        "ko": "495"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 2316,
        "percentage": 12
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 499,
        "percentage": 2
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 13539,
        "percentage": 67
    },
    "group4": {
        "name": "failed",
        "count": 3746,
        "percentage": 19
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "76.718",
        "ok": "62.42",
        "ko": "14.298"
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
        "ok": "15696",
        "ko": "4404"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "36",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "34884",
        "ok": "34884",
        "ko": "13742"
    },
    "meanResponseTime": {
        "total": "7953",
        "ok": "10160",
        "ko": "87"
    },
    "standardDeviation": {
        "total": "7727",
        "ok": "7350",
        "ko": "850"
    },
    "percentiles1": {
        "total": "6788",
        "ok": "11387",
        "ko": "0"
    },
    "percentiles2": {
        "total": "15403",
        "ok": "16497",
        "ko": "0"
    },
    "percentiles3": {
        "total": "20078",
        "ok": "20501",
        "ko": "0"
    },
    "percentiles4": {
        "total": "22628",
        "ok": "22876",
        "ko": "3681"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1819,
        "percentage": 9
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 335,
        "percentage": 2
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 13542,
        "percentage": 67
    },
    "group4": {
        "name": "failed",
        "count": 4404,
        "percentage": 22
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "76.718",
        "ok": "59.908",
        "ko": "16.809"
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
