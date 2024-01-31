<template>
    
    <div class="ip-address-container">
        <H1>Welcome to Paul's Assessment Attempt</H1>
        <button @click="fetchIpAddress">Get IP Address</button>
        <div v-if="ipAddress" class="ip-address-info">
            <h2>Your IP Address is:</h2>
            <p>{{ ipAddress }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ipAddress: null,
        };
    },
    methods: {
        //This method will try to fetch the IP Address from the mtt-ip-rquest route
        async fetchIpAddress() {
            try {
                const response = await fetch('/mqtt-ip-request');
                const data = await response.json();
                this.ipAddress = data['The ip_address is'];
            } catch (error) {
                console.error('Error fetching IP address:', error);
            }
        },
    },
};
</script>

<style scoped>

.ip-address-container {
    text-align: center;
    margin-top: 20px;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.ip-address-info {
    margin-top: 20px;
}

h2 {
    font-size: 18px;
    color: #333;
}

p {
    font-size: 16px;
    color: #777;
}
</style>
